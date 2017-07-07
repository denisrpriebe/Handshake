<?php

namespace IrishTitan\Handshake\Tests\Features;

use IrishTitan\Handshake\Core\App;
use IrishTitan\Handshake\Core\Session;
use IrishTitan\Handshake\Tests\TestCase;

class SessionTest extends TestCase
{
    /**
     * The session instance.
     *
     * @var
     */
    protected $session;

    /**
     * Get our class ready for testing.
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->session = App::make(Session::class);
    }

    /** @test */
    public function it_stores_and_retrieves_values()
    {
        $this->session->set('my-value', 1234);

        $this->assertSame(1234, $this->session->get('my-value'));
    }

    /** @test */
    public function it_determines_if_values_are_set()
    {
        $this->session->set('first-value', 'ABC');

        $this->assertTrue($this->session->has('first-value'));

        $this->assertFalse($this->session->has('does-not-exist'));
    }

    /** @test */
    public function it_forgets_values()
    {
        $this->session->set('my-value', 123);

        $this->assertSame(123, $this->session->get('my-value'));

        $this->session->forget('my-value');

        $this->assertFalse($this->session->has('my-value'));
    }

    /** @test */
    public function it_destroys_the_session()
    {
        $this->session->set('my-value', 123);
        $this->session->set('my-other-value', [1, 2, 3]);

        $this->session->flush();

        $this->assertFalse($this->session->has('my-value'));
        $this->assertFalse($this->session->has('my-other-value'));
    }


}