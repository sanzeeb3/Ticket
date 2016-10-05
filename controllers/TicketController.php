<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Seat;
use app\models\Users;
use app\models\BookSeat;

class TicketController extends Controller
{
    public function behaviors()
    {
       return [
           'access' => [
                'class' => AccessControl::className(),
                'only' => ['user','admin'],
                'rules' => [
                // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                 ],
            ],
        ];
    }

	public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetseats()
    {
    	if(Yii::$app->request->isAjax)
    	{
    		$type=$_POST['type'];
            $flightdate=$_POST['flightdate'];
            
            if($type && $flightdate)
    		{
                $sql="SELECT * FROM seat S WHERE S.seat_id NOT IN
                        (SELECT BS.seat_id FROM book_seat BS WHERE BS.date_booked = '$flightdate')
                      AND S.type = $type";

		 		$getseats=Yii::$app->db->createCommand($sql)->queryAll();

	    		echo json_encode(array('status' => TRUE,  'getseats'=>$getseats)); die;
	    	}
		}
			echo json_encode(FALSE);die;
    }

    public function actionBook()
    {
        if(Yii::$app->request->isAjax)
        {
            $add=new Users();
            $add->name=$_POST['name'];
            $add->username=$_POST['username'];
            $add->password=Yii::$app->security->generatePasswordHash($_POST['password']);
            $add->contact=$_POST['contact'];

            if($add->save())
            {
                $getlast=Yii::$app->db->getLastInsertId();
                $seats=$_POST['seats'];
                foreach($seats as $seat)
                {
                    $add=new BookSeat();
                    $add->date_booked=$_POST['flightdate'];
                    $add->user_id=$getlast;
                    $add->seat_id=$seat;
                    $add->save();
                 }
                echo json_encode(TRUE);die;                
            }
            echo json_encode(FALSE);die;   
        }    
        echo json_encode(FALSE);die;   
    }

    public function actionAdmin()
    {
        $allresults = BookSeat::find()->with('seat')     //Model BookSeat has relation seat 
                                      ->with('user')
                                      ->all();                                                                                                      
        return $this->render('admin', ['allresults'=>$allresults]);
    }

    public function actionShow()
    {
        if(Yii::$app->request->isAjax)
        {
            $name=Yii::$app->request->post('name');
            $type=Yii::$app->request->post('type');
            $flightdate=Yii::$app->request->post('flightdate');
            $seat=Yii::$app->request->post('seat');
                     
            $sql="SELECT * FROM book_seat INNER JOIN seat ON book_seat.seat_id=seat.seat_id
                                          INNER JOIN users ON book_seat.user_id=users.user_id
                                          WHERE 1=1";
            if($type)
            {
               $sql.= " AND seat.type=$type";    
            }

            if($name)
            {
               $sql.= " AND users.name='$name'";    
            }

            if($flightdate)
            {
                $sql.= " AND book_seat.date_booked='$flightdate'";
            }

            if($seat)
            {
                $sql.=" AND seat.seat=$seat";
            }

            $display=Yii::$app->db->createCommand($sql)->queryAll();
            if(!empty($display))
            {
                echo json_encode(array('status' => TRUE,  'display'=>$display)); die; 
            }
        }    
        echo json_encode(FALSE);die;
    }


    public function actionTry()
    {
        $results = BookSeat::find()->where(['seat_id' =>3])
                                   ->with('seat')     //Model BookSeat has relation seat 
                                   ->with('user')                                                                                     
                                   ->all(); 

        foreach($results as $result)
            {
                echo"<pre>"; print_r($result->seat->seat);
                echo"<pre>"; print_r($result->user->name);
                echo"<pre>"; print_r($result->date_booked);
            }
    }


    public function actionTryAnother()
    {
        $results = Users::find()->where(['user_id' =>26])                
                                   ->with('books')
                                   ->with('books.seat')   //Model Users has relation books and table in books has relation seat                                                         
                                   ->one(); 

        foreach($results->books  as $book)          //users has oneToMany relation with books
        {        
                    echo"<pre>"; print_r($book->date_booked);
                    echo"<pre>"; print_r($book->seat_id);                    
                    echo"<pre>"; print_r($results->name);
                    echo"<pre>"; print_r($results->user_id);
                               
        }
    }


    public function actionTryYetAnother()
    {
        $results = Seat::find()->where(['type' =>1])                
                               ->with('books')                                                                                     
                               ->all(); 

        foreach($results as $result)
        {                           
           foreach($result->books  as $book)
            {        
                    echo"<pre>"; print_r($book->date_booked);
                    echo"<pre>"; print_r($book->seat_id);                    
            }
        }
    }

    public function actionCancel()
    {
        if(Yii::$app->request->isAjax)
        {
            $delete=BookSeat::find()->where(['id' =>$_POST['id']])->one();
            if($delete)
            {
                $delete->delete();
                echo json_encode(TRUE);die;        
            }  
             echo json_encode(FALSE);die;     
        }   
        echo json_encode(FALSE);die;   
    }

}