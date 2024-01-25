<?php

namespace backend\models;

use common\models\Servico;

/**
 * This is the model class for table "estabelecimentos".
 *
 * @property int $id
 * @property string $nome
 * @property string $morada
 * @property int $telefone
 * @property string $email
 *
 * @property Despesa[] $despesas
 * @property Servico[] $servicos
 * @property ServicoEstabelecimento[] $servicosEstabelecimentos
 */
class Estabelecimento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estabelecimentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'morada', 'telefone', 'email'], 'required'],
            [['telefone'], 'integer'],
            [['nome'], 'string', 'max' => 30],
            [['morada'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'morada' => 'Morada',
            'telefone' => 'Telefone',
            'email' => 'Email',
        ];
    }

    /**
     * Gets query for [[Despesas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDespesas()
    {
        return $this->hasMany(Despesa::class, ['estabelecimento_id' => 'id']);
    }

    /**
     * Gets query for [[Servicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicos()
    {
        return $this->hasMany(Servico::class, ['id' => 'servico_id'])->viaTable('servicos_estabelecimentos', ['estabelecimento_id' => 'id']);
    }

    /**
     * Gets query for [[ServicosEstabelecimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicosEstabelecimentos()
    {
        return $this->hasMany(ServicoEstabelecimento::class, ['estabelecimento_id' => 'id']);
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }


    public function setMorada($morada)
    {
        $this->morada = $morada;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
