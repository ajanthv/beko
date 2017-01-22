<?php

use Mockery as m;

class UserRepositoryTest extends TestCase
{
    

    public function testGetPromotions()
    {
        $result = (object)[
            0 => (object)['id' => 1, 'title'=>'title', 'image'=>'image', 'bank_id'=>1, 'creditcards'=>'["1","2"]'],
            1 => (object)['id' => 2, 'title'=>'title', 'image'=>'image', 'bank_id'=>1, 'creditcards'=>'["1","2"]']
        ];
        
        //mock db connection
        $dbMock = m::mock('App\Models\Promotion')
            ->shouldReceive('where')
            ->andReturnSelf()
            ->shouldReceive('get')
            ->andReturn($result)
            ->getMock();


        $this->app->instance('App\Models\Promotion', $dbMock);
        $repo = $this->app->make('App\Repositories\Contracts\UserRepositoryInterface');
        $this->assertSame($result, $repo->getPromotions(1));
    }

//    public function testGetGroupUsersPagination()
//    {
//        //mock db connection
//        $dbMock = m::mock('App\Models\User')
//            ->shouldReceive('join')
//            ->with('set_user_groups', 'set_user_groups.user_id', '=', 'users.id')
//            ->andReturnSelf()
//            ->shouldReceive('where')
//            ->with('set_user_groups.group_id', 1)
//            ->andReturnSelf()
//            ->shouldReceive('groupBy')
//            ->andReturnSelf('users.id')
//            ->shouldReceive('select')
//            ->andReturnSelf()
//            ->shouldReceive('orderBy')
//            ->andReturnSelf('any')
//            ->shouldReceive('paginate')
//            ->andReturn([
//                'users.id' =>  'id',
//                'users.first_name' =>  'first_name',
//                'users.last_name' =>  'last_name'
//            ])
//            ->getMock();
//
//
//        $this->app->instance('App\Models\User', $dbMock);
//        $repo = $this->app->make('App\Repositories\Current\Contracts\UserRepositoryInterface');
//        $this->assertSame([
//            'users.id' =>  'id',
//            'users.first_name' =>  'first_name',
//            'users.last_name' =>  'last_name'
//        ], $repo->getGroupUsersPagination(1, null, 1, 'ASC', 'first_name'));
//    }
//
//    public function testGetGroupUsersPaginationWithName()
//    {
//        //mock db connection
//        $dbMock = m::mock('App\Models\User')
//            ->shouldReceive('join')
//            ->with('set_user_groups', 'set_user_groups.user_id', '=', 'users.id')
//            ->andReturnSelf()
//            ->shouldReceive('where')
//            ->with('set_user_groups.group_id', 1)
//            ->andReturnSelf()
//            ->shouldReceive('where')
//            ->with('first_name', 'LIKE', '%name%')
//            ->andReturnSelf()
//            ->shouldReceive('orWhere')
//            ->with('last_name', 'LIKE', '%name%')
//            ->andReturnSelf()
//            ->shouldReceive('groupBy')
//            ->andReturnSelf('users.id')
//            ->shouldReceive('select')
//            ->andReturnSelf()
//            ->shouldReceive('orderBy')
//            ->andReturnSelf('ASC', 'first_name')
//            ->shouldReceive('paginate')
//            ->andReturn([
//                'users.id' =>  'id',
//                'users.first_name' =>  'first_name',
//                'users.last_name' =>  'last_name'
//            ])
//            ->getMock();
//
//
//        $this->app->instance('App\Models\User', $dbMock);
//        $repo = $this->app->make('App\Repositories\Current\Contracts\UserRepositoryInterface');
//        $this->assertSame([
//            'users.id' =>  'id',
//            'users.first_name' =>  'first_name',
//            'users.last_name' =>  'last_name'
//        ], $repo->getGroupUsersPagination(1, 'name', 1, 'ASC', 'first_name'));
//    }
//
//    public function testGetPayslipId()
//    {
//        //mock db connection
//        $dbMock = m::mock('App\Models\TrnPayslips')
//            ->shouldReceive('where')
//            ->with('user_id', 1)
//            ->andReturnSelf()
//            ->shouldReceive('select')
//            ->andReturnSelf()
//            ->shouldReceive('orderBy')
//            ->andReturnSelf('payslip_id', 'DESC')
//            ->shouldReceive('first')
//            ->andReturn([
//                'users_id' =>  'id',
//                'payrun_number' =>  'payrun_number',
//                'staff_number' =>  'staff_number'
//            ])
//            ->getMock();
//
//
//        $this->app->instance('App\Models\TrnPayslips', $dbMock);
//        $repo = $this->app->make('App\Repositories\Current\Contracts\UserRepositoryInterface');
//        $this->assertSame([
//            'users_id' =>  'id',
//            'payrun_number' =>  'payrun_number',
//            'staff_number' =>  'staff_number'
//        ], $repo->getPayslipId(1, null));
//    }
//
//    public function testGetPayslipIdWithPayRunNumber()
//    {
//        //mock db connection
//        $dbMock = m::mock('App\Models\TrnPayslips')
//            ->shouldReceive('where')
//            ->with('user_id', 1)
//            ->andReturnSelf()
//            ->shouldReceive('where')
//            ->with('payrun_number', 100)
//            ->andReturnSelf()
//            ->shouldReceive('select')
//            ->andReturnSelf()
//            ->shouldReceive('orderBy')
//            ->andReturnSelf('payslip_id', 'DESC')
//            ->shouldReceive('first')
//            ->andReturn([
//                'users_id' =>  'id',
//                'payrun_number' =>  'payrun_number',
//                'staff_number' =>  'staff_number'
//            ])
//            ->getMock();
//
//
//        $this->app->instance('App\Models\TrnPayslips', $dbMock);
//        $repo = $this->app->make('App\Repositories\Current\Contracts\UserRepositoryInterface');
//        $this->assertSame([
//            'users_id' =>  'id',
//            'payrun_number' =>  'payrun_number',
//            'staff_number' =>  'staff_number'
//        ], $repo->getPayslipId(1, 100));
//    }
//
//    public function testGetMobilePayData()
//    {
//        //mock db connection
//        $dbMock = m::mock('Illuminate\Database\Connection')
//            ->shouldReceive('table')
//            ->with('trn_payslip_userpaydetails_mobile')
//            ->andReturnSelf()
//            ->shouldReceive('where')
//            ->with('payslip_id', 1)
//            ->andReturnSelf()
//            ->shouldReceive('whereIn')
//            ->with('pay_code', [
//                'cpabasehrs[1]',
//                'cpabasehrs[2]',
//                'cpaotimhrs[1]',
//                'cpaotimhrs[2]',
//                'cpabasepay[1]',
//                'cpabasepay[2]',
//                'cpaovertime[1]',
//                'cpaovertime[2]',
//                'cpaalwbefr[1]',
//                'cpaalwbefr[2]',
//                'cpaalwaftr[1]',
//                'cpaalwaftr[2]',
//                'cpagross[1]',
//                'cpagross[2]',
//                'cpataxbsal[1]',
//                'cpataxbsal[2]',
//                'pypbtaxded',
//                'pypataxded',
//                'cpastuloan[1]',
//                'cpastuloan[2]',
//                'cpaesupbt[1]',
//                'cpaesupbt[2]',
//                'cpacomsupr[1]',
//                'cpacomsupr[2]',
//                'cpatax[1]',
//                'cpatax[2]',
//                'cpanet[1]',
//                'cpanet[2]'
//            ])
//            ->andReturnSelf()
//            ->shouldReceive('select')
//            ->andReturnSelf()
//            ->shouldReceive('get')
//            ->andReturn((object)[
//                (object)[
//                    'pay_code' => 'cpabasehrs[1]',
//                    'amount' => 10]
//
//            ])
//            ->getMock();
//
//        $this->app->instance('Illuminate\Database\Connection', $dbMock);
//        $repo = $this->app->make('App\Repositories\Current\Contracts\UserRepositoryInterface');
//        $this->assertSame([
//            'cpabasehrs[1]' => '10.00',
//            'cpaotimhrs[1]' => '0.00',
//            'cpabasepay[1]' => '0.00',
//            'cpaovertime[1]' => '0.00',
//            'cpaalwbefr[1]' => '0.00',
//            'cpaalwaftr[1]' => '0.00',
//            'cpagross[1]' => '0.00',
//            'cpataxbsal[1]' => '0.00',
//            'pypbtaxded' => '0.00',
//            'pypataxded' => '0.00',
//            'cpastuloan[1]' => '0.00',
//            'cpaesupbt[1]' => '0.00',
//            'cpacomsupr[1]' => '0.00',
//            'cpatax[1]' => '0.00',
//            'cpanet[1]' => '0.00',
//        ], $repo->getMobilePayData(1));
//    }
//
//    public function testGetMobilePayDataForPDF()
//    {
//        //mock db connection
//        $dbMock = m::mock('Illuminate\Database\Connection')
//            ->shouldReceive('table')
//            ->with('trn_payslip_userpaydetails_mobile')
//            ->andReturnSelf()
//            ->shouldReceive('where')
//            ->with('payslip_id', 1)
//            ->andReturnSelf()
//            ->shouldReceive('whereIn')
//            ->with('pay_code', ['cpagross[1]', 'cpanet[1]', 'cpatax[1]', 'pypgross', 'pyptaxamt', 'pypnettamt'])
//            ->andReturnSelf()
//            ->shouldReceive('select')
//            ->andReturnSelf()
//            ->shouldReceive('get')
//            ->andReturn((object)[
//                (object)[
//                    'pay_code' => 'cpagross[1]',
//                    'amount' => 10],
//                (object)[
//                    'pay_code' => 'cpanet[1]',
//                    'amount' => 10],
//                (object)[
//                    'pay_code' => 'cpatax[1]',
//                    'amount' => 10],
//                (object)[
//                    'pay_code' => 'pypgross',
//                    'amount' => 10],
//                (object)[
//                    'pay_code' => 'pyptaxamt',
//                    'amount' => 10],
//                (object)[
//                    'pay_code' => 'pypnettamt',
//                    'amount' => 10]
//
//            ])
//            ->getMock();
//
//        $this->app->instance('Illuminate\Database\Connection', $dbMock);
//        $repo = $this->app->make('App\Repositories\Current\Contracts\UserRepositoryInterface');
//        $this->assertSame([
//            'cpagross' => 10,
//            'cpanet' => 10,
//            'cpatax' => 10,
//            'pypgross' => 10,
//            'pyptaxamt' => 10,
//            'pypnettamt' => 10
//        ], $repo->getMobilePayDataForPDF(1));
//    }
}
