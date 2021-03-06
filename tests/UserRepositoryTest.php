<?php

use Mockery as m;

class UserRepositoryTest extends TestCase
{


    /**
     * Test 
     */
    public function testGetPromotions()
    {
        $result = (object)[
            0 => (object)['id' => 1, 'title'=>'title', 'image'=>'image', 'bank_id'=>1, 'creditcards'=>'["1","2"]'],
            1 => (object)['id' => 2, 'title'=>'title', 'image'=>'image', 'bank_id'=>1, 'creditcards'=>'["1","2"]']
        ];

        $failResult = (object)[
            0 => (object)['id' => 1, 'title'=>'title', 'image'=>'image', 'bank_id'=>1, 'creditcards'=>'["1","2"]'],
            1 => (object)['id' => 2, 'title'=>'title', 'image'=>'image', 'bank_id'=>1]
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
        $this->assertSame($failResult, $repo->getPromotions(1));
    }
}
