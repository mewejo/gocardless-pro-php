<?php
//
// WARNING: Do not edit by hand, this file was generated by Crank:
// https://github.com/gocardless/crank
//

namespace GoCardlessPro\Integration;

class BlocksIntegrationTest extends IntegrationTestBase
{
    public function testResourceModelExists()
    {
        $obj = new \GoCardlessPro\Resources\Block(array());
        $this->assertNotNull($obj);
    }
    
    public function testBlocksCreate()
    {
        $fixture = $this->loadJsonFixture('blocks')->create;
        $this->stub_request($fixture);

        $service = $this->client->blocks();
        $response = call_user_func_array(array($service, 'create'), (array)$fixture->url_params);

        $body = $fixture->body->blocks;
    
        $this->assertInstanceOf('\GoCardlessPro\Resources\Block', $response);

        $this->assertEquals($body->active, $response->active);
        $this->assertEquals($body->block_type, $response->block_type);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->reason_description, $response->reason_description);
        $this->assertEquals($body->reason_type, $response->reason_type);
        $this->assertEquals($body->resource_reference, $response->resource_reference);
        $this->assertEquals($body->updated_at, $response->updated_at);
    

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    public function testBlocksCreateWithIdempotencyConflict()
    {
        $fixture = $this->loadJsonFixture('blocks')->create;

        $idempotencyConflictResponseFixture = $this->loadFixture('idempotent_creation_conflict_invalid_state_error');

        // The POST request responds with a 409 to our original POST, due to an idempotency conflict
        $this->mock->append(new \GuzzleHttp\Psr7\Response(409, [], $idempotencyConflictResponseFixture));

        // The client makes a second request to fetch the resource that was already
        // created using our idempotency key. It responds with the created resource,
        // which looks just like the response for a successful POST request.
        $this->mock->append(new \GuzzleHttp\Psr7\Response(200, [], json_encode($fixture->body)));

        $service = $this->client->blocks();
        $response = call_user_func_array(array($service, 'create'), (array)$fixture->url_params);
        $body = $fixture->body->blocks;

        $this->assertInstanceOf('\GoCardlessPro\Resources\Block', $response);

        $this->assertEquals($body->active, $response->active);
        $this->assertEquals($body->block_type, $response->block_type);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->reason_description, $response->reason_description);
        $this->assertEquals($body->reason_type, $response->reason_type);
        $this->assertEquals($body->resource_reference, $response->resource_reference);
        $this->assertEquals($body->updated_at, $response->updated_at);
        

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $conflictRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $conflictRequest->getUri()->getPath());
        $getRequest = $this->history[1]['request'];
        $this->assertEquals($getRequest->getUri()->getPath(), '/blocks/ID123');
    }
    
    public function testBlocksGet()
    {
        $fixture = $this->loadJsonFixture('blocks')->get;
        $this->stub_request($fixture);

        $service = $this->client->blocks();
        $response = call_user_func_array(array($service, 'get'), (array)$fixture->url_params);

        $body = $fixture->body->blocks;
    
        $this->assertInstanceOf('\GoCardlessPro\Resources\Block', $response);

        $this->assertEquals($body->active, $response->active);
        $this->assertEquals($body->block_type, $response->block_type);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->reason_description, $response->reason_description);
        $this->assertEquals($body->reason_type, $response->reason_type);
        $this->assertEquals($body->resource_reference, $response->resource_reference);
        $this->assertEquals($body->updated_at, $response->updated_at);
    

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    
    public function testBlocksList()
    {
        $fixture = $this->loadJsonFixture('blocks')->list;
        $this->stub_request($fixture);

        $service = $this->client->blocks();
        $response = call_user_func_array(array($service, 'list'), (array)$fixture->url_params);

        $body = $fixture->body->blocks;
    
        $records = $response->records;
        $this->assertInstanceOf('\GoCardlessPro\Core\ListResponse', $response);
        $this->assertInstanceOf('\GoCardlessPro\Resources\Block', $records[0]);

        $this->assertEquals($fixture->body->meta->cursors->before, $response->before);
        $this->assertEquals($fixture->body->meta->cursors->after, $response->after);
    

    
        foreach (range(0, count($body) - 1) as $num) {
            $record = $records[$num];
            $this->assertEquals($body[$num]->active, $record->active);
            $this->assertEquals($body[$num]->block_type, $record->block_type);
            $this->assertEquals($body[$num]->created_at, $record->created_at);
            $this->assertEquals($body[$num]->id, $record->id);
            $this->assertEquals($body[$num]->reason_description, $record->reason_description);
            $this->assertEquals($body[$num]->reason_type, $record->reason_type);
            $this->assertEquals($body[$num]->resource_reference, $record->resource_reference);
            $this->assertEquals($body[$num]->updated_at, $record->updated_at);
            
        }

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    
    public function testBlocksDisable()
    {
        $fixture = $this->loadJsonFixture('blocks')->disable;
        $this->stub_request($fixture);

        $service = $this->client->blocks();
        $response = call_user_func_array(array($service, 'disable'), (array)$fixture->url_params);

        $body = $fixture->body->blocks;
    
        $this->assertInstanceOf('\GoCardlessPro\Resources\Block', $response);

        $this->assertEquals($body->active, $response->active);
        $this->assertEquals($body->block_type, $response->block_type);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->reason_description, $response->reason_description);
        $this->assertEquals($body->reason_type, $response->reason_type);
        $this->assertEquals($body->resource_reference, $response->resource_reference);
        $this->assertEquals($body->updated_at, $response->updated_at);
    

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    public function testBlocksDisableWithIdempotencyConflict()
    {
        $fixture = $this->loadJsonFixture('blocks')->disable;

        $idempotencyConflictResponseFixture = $this->loadFixture('idempotent_creation_conflict_invalid_state_error');

        // The POST request responds with a 409 to our original POST, due to an idempotency conflict
        $this->mock->append(new \GuzzleHttp\Psr7\Response(409, [], $idempotencyConflictResponseFixture));

        // The client makes a second request to fetch the resource that was already
        // created using our idempotency key. It responds with the created resource,
        // which looks just like the response for a successful POST request.
        $this->mock->append(new \GuzzleHttp\Psr7\Response(200, [], json_encode($fixture->body)));

        $service = $this->client->blocks();
        $response = call_user_func_array(array($service, 'disable'), (array)$fixture->url_params);
        $body = $fixture->body->blocks;

        $this->assertInstanceOf('\GoCardlessPro\Resources\Block', $response);

        $this->assertEquals($body->active, $response->active);
        $this->assertEquals($body->block_type, $response->block_type);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->reason_description, $response->reason_description);
        $this->assertEquals($body->reason_type, $response->reason_type);
        $this->assertEquals($body->resource_reference, $response->resource_reference);
        $this->assertEquals($body->updated_at, $response->updated_at);
        

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $conflictRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $conflictRequest->getUri()->getPath());
        $getRequest = $this->history[1]['request'];
        $this->assertEquals($getRequest->getUri()->getPath(), '/blocks/ID123');
    }
    
    public function testBlocksEnable()
    {
        $fixture = $this->loadJsonFixture('blocks')->enable;
        $this->stub_request($fixture);

        $service = $this->client->blocks();
        $response = call_user_func_array(array($service, 'enable'), (array)$fixture->url_params);

        $body = $fixture->body->blocks;
    
        $this->assertInstanceOf('\GoCardlessPro\Resources\Block', $response);

        $this->assertEquals($body->active, $response->active);
        $this->assertEquals($body->block_type, $response->block_type);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->reason_description, $response->reason_description);
        $this->assertEquals($body->reason_type, $response->reason_type);
        $this->assertEquals($body->resource_reference, $response->resource_reference);
        $this->assertEquals($body->updated_at, $response->updated_at);
    

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    public function testBlocksEnableWithIdempotencyConflict()
    {
        $fixture = $this->loadJsonFixture('blocks')->enable;

        $idempotencyConflictResponseFixture = $this->loadFixture('idempotent_creation_conflict_invalid_state_error');

        // The POST request responds with a 409 to our original POST, due to an idempotency conflict
        $this->mock->append(new \GuzzleHttp\Psr7\Response(409, [], $idempotencyConflictResponseFixture));

        // The client makes a second request to fetch the resource that was already
        // created using our idempotency key. It responds with the created resource,
        // which looks just like the response for a successful POST request.
        $this->mock->append(new \GuzzleHttp\Psr7\Response(200, [], json_encode($fixture->body)));

        $service = $this->client->blocks();
        $response = call_user_func_array(array($service, 'enable'), (array)$fixture->url_params);
        $body = $fixture->body->blocks;

        $this->assertInstanceOf('\GoCardlessPro\Resources\Block', $response);

        $this->assertEquals($body->active, $response->active);
        $this->assertEquals($body->block_type, $response->block_type);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->reason_description, $response->reason_description);
        $this->assertEquals($body->reason_type, $response->reason_type);
        $this->assertEquals($body->resource_reference, $response->resource_reference);
        $this->assertEquals($body->updated_at, $response->updated_at);
        

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $conflictRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $conflictRequest->getUri()->getPath());
        $getRequest = $this->history[1]['request'];
        $this->assertEquals($getRequest->getUri()->getPath(), '/blocks/ID123');
    }
    
}
