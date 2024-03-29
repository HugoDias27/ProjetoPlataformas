<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class CarrinhoCest
{

    protected FunctionalTester $tester;

    // Teste para realizar uma compra com um produto com receita médica
    public function testeProdutoComReceita(FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Bem-Vindo à Carolo Farmacêutica!');
        $I->click('Login');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('#username', 'Tiago Saramago');
        $I->fillField('#password', 'tiago.saramago2023');
        $I->click('login-button');
        $I->see('Logout (Tiago Saramago)');

        $I->click('Brufen Sem Açúcar, 20 mg/mL-200mL');
        $I->see('Brufen Sem Açúcar, 20 mg/mL-200mL');
        $I->see('Informações Técnicas');
        $I->click('Adicionar ao Carrinho');

        $I->fillField('ReceitaMedica[codigo]', '5678');
        $I->see('Verificar');
        $I->click('Verificar');
        $I->click('Carrinho');

        $I->see('Carrinho Compras');
        $I->see('Concluir Carrinho');
        $I->click('Concluir Carrinho');
        $I->see('Dados de Entrega');
        $I->click('Concluir Compra');
    }

    // Teste para realizar uma compra sem um produto com receita médica
    public function testeProdutoSemReceita(FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Bem-Vindo à Carolo Farmacêutica!');
        $I->click('Login');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('#username', 'Tiago Saramago');
        $I->fillField('#password', 'tiago.saramago2023');
        $I->click('login-button');
        $I->see('Logout (Tiago Saramago)');
        $I->see('Ben-U-Ron, 500 mg x 20 comp');
        $I->click('Ben-U-Ron, 500 mg x 20 comp');
        $I->see('Informações Técnicas');
        $I->click('Adicionar ao Carrinho');
        $I->see('Carrinho');
        $I->click('Carrinho');
        $I->see('Carrinho Compras');
        $I->fillField('quantidade', '3');
        $I->click('Atualizar');
        $I->click('Concluir Carrinho');
        $I->see('Dados de Entrega');
        $I->click('Concluir Compra');
    }
}
