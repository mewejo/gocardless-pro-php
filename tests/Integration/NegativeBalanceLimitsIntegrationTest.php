<?php
//
// WARNING: Do not edit by hand, this file was generated by Crank:
// https://github.com/gocardless/crank
//

namespace GoCardlessPro\Integration;

class NegativeBalanceLimitsIntegrationTest extends IntegrationTestBase
{
    public function testResourceModelExists()
    {
        $obj = new \GoCardlessPro\Resources\NegativeBalanceLimit(array());
        $this->assertNotNull($obj);
    }
    
    public function testNegativeBalanceLimitsList()
    {
        $fixture = $this->loadJsonFixture('negative_balance_limits')->list;
        $this->stub_request($fixture);

        $service = $this->client->negativeBalanceLimits();
        $response = call_user_func_array(array($service, 'list'), (array)$fixture->url_params);

        $body = $fixture->body->negative_balance_limits;
    
        $records = $response->records;
        $this->assertInstanceOf('\GoCardlessPro\Core\ListResponse', $response);
        $this->assertInstanceOf('\GoCardlessPro\Resources\NegativeBalanceLimit', $records[0]);
        if (!is_null($fixture->body) && property_exists($fixture->body, 'meta') && !is_null($fixture->body->meta)) {
            $this->assertEquals($fixture->body->meta->cursors->before, $response->before);
            $this->assertEquals($fixture->body->meta->cursors->after, $response->after);
        }
    

    
        foreach (range(0, count($body) - 1) as $num) {
            $record = $records[$num];
            
            if (isset($body[$num]->active)) {
                $this->assertEquals($body[$num]->active, $record->active);
            }
            
            if (isset($body[$num]->balance_limit)) {
                $this->assertEquals($body[$num]->balance_limit, $record->balance_limit);
            }
            
            if (isset($body[$num]->created_at)) {
                $this->assertEquals($body[$num]->created_at, $record->created_at);
            }
            
            if (isset($body[$num]->currency)) {
                $this->assertEquals($body[$num]->currency, $record->currency);
            }
            
            if (isset($body[$num]->id)) {
                $this->assertEquals($body[$num]->id, $record->id);
            }
            
            if (isset($body[$num]->links)) {
                $this->assertEquals($body[$num]->links, $record->links);
            }
            
            if (isset($body[$num]->reason)) {
                $this->assertEquals($body[$num]->reason, $record->reason);
            }
            
            if (isset($body[$num]->updated_at)) {
                $this->assertEquals($body[$num]->updated_at, $record->updated_at);
            }
            
        }

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertMatchesRegularExpression($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    
    public function testNegativeBalanceLimitsCreate()
    {
        $fixture = $this->loadJsonFixture('negative_balance_limits')->create;
        $this->stub_request($fixture);

        $service = $this->client->negativeBalanceLimits();
        $response = call_user_func_array(array($service, 'create'), (array)$fixture->url_params);

        $body = $fixture->body->negative_balance_limits;
    
        $this->assertInstanceOf('\GoCardlessPro\Resources\NegativeBalanceLimit', $response);

        $this->assertEquals($body->active, $response->active);
        $this->assertEquals($body->balance_limit, $response->balance_limit);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->currency, $response->currency);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->links, $response->links);
        $this->assertEquals($body->reason, $response->reason);
        $this->assertEquals($body->updated_at, $response->updated_at);
    

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertMatchesRegularExpression($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    
}
