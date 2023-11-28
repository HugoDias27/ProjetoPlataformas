<?php

namespace common\models;

use Yii;
use yii\validators\FileValidator;

/**
 * This is the model class for table "imagens".
 *
 * @property int $id
 * @property string $filename
 * @property int $produto_id
 *
 * @property Produto $produto
 */
class Imagem extends \yii\db\ActiveRecord
{

    public $imagem;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename'], 'file', 'skipOnEmpty' => false, 'extensions'=>'png,jpg', 'maxFiles' => 3],
            [['filename', 'produto_id'], 'required'],
            [['produto_id'], 'integer'],
            [['filename'], 'string', 'max' => 60],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::class, 'targetAttribute' => ['produto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
            'produto_id' => 'Produto ID',
        ];
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::class, ['id' => 'produto_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->Imagem as $item)
            $item->saveAs('uploads/' . $item->filename->baseName . '.' . $item->extension);

            return true;
        } else {
            return false;
        }
    }
}
