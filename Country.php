<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property string $code
 * @property string $name
 * @property int $population
 */
class Country extends \yii\db\ActiveRecord
{
    private static $db;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['population'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 52],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'population' => 'Population',
        ];
    }

    public function setDb()
    {
        if($this->beginsWithVowelLetter($this->name)){
            self::$db = 'db';
        }else{
            self::$db = 'db2';
        }
    }

    public static function getDb()
    {
        $db = self::$db;
        if(isset($db)){
            self::$db = null;
            return \Yii::$app->get($db);
        }else{
            return parent::getDb();
        }
    }

    protected function beginsWithVowelLetter(string $string)
    {
        $vowelLetters = ['a', 'e', 'i', 'o', 'u', 'y'];

        $firstLetter = mb_substr($string, 0, 1);

        return in_array($firstLetter, $vowelLetters);
    }
}
