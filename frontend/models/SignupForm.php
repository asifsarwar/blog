<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Userprofile;
use yii\web\UploadedFile;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $imagepath;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            //[['imagepath'], 'file', 'extensions' => 'png, jpg, gif, jpeg'],
            //['imagepath', 'safe'],
            ['email', 'trim'],
            [['email', 'firstname','lastname'],'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        //echo "I am before save";
        if($user->save()){

            $userprofile = new Userprofile();
            $userprofile->user_id = $user->id;
            $userprofile->fname = $this->firstname;
            $userprofile->lname = $this->lastname;
            $userprofile->imagepath = $this->username.'-'. $this->imagepath->baseName . '.' . $this->imagepath->extension;
            print_r($userprofile).'<br/>';
            
            if($userprofile->save()){
                echo 'Successfully saved';
                //exit;
            }else{
                print_r($userprofile->getErrors());
                //exit;
            }
            //print_r($userprofile);
            //exit;
            return $user;
        }else return null;
    }
    public function upload()
    {
        //if ($this->validate()) {
            $this->imagepath->saveAs('img/' .$this->username.'-'. $this->imagepath->baseName . '.' . $this->imagepath->extension);
            return true;
        //} else {
         //   return false;
        //}
    }
}
