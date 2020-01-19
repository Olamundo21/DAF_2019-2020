<?php

namespace spec\App\Application;

use App\Application\Pagination;
use App\Application\QueryResult;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueryResultSpec extends ObjectBehavior
{

    private $data;

    function let()
    {
        $this->data = ['one', 'tow', 'tree'];
        $this->beConstructedWith($this->data);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(QueryResult::class);
    }

    function it_can_have_a_list_of_attributes()
    {
        $this->attributes()->shouldBeArray();
    }

    function it_can_add_new_attributes()
    {
        $this->addAttribute('foo', 'bar')->shouldBe($this->getWrappedObject());
        $this->attribute('foo')->shouldBe('bar');
        $this->attribute('bar')->shouldBeNull();
        $this->attribute('baz', 'test')->shouldBe('test');
    }

    function it_can_remove_an_attribute()
    {
        $this->addAttribute('foo', 'bar');
        $this->attribute('foo')->shouldBe('bar');
        $this->removeAttribute('foo')->shouldBe($this->getWrappedObject());
        $this->attribute('foo')->shouldBeNull();
    }

    function its_iterable()
    {
        $this->shouldBeAnInstanceOf(\IteratorAggregate::class);
        $this->getIterator()->shouldBeAnInstanceOf(\ArrayIterator::class);
    }

    /**
     * @throws FailureException
     */
    function it_can_ne_counted()
    {
        $this->shouldBeAnInstanceOf(\Countable::class);
        $this->count()->shouldBe(3);
        if (empty($this->getWrappedObject())) {
            throw new FailureException(
                "Query result should not be empty..."
            );
        }
        $this->isEmpty()->shouldBe(false);
    }

    function it_can_be_paginated()
    {
        $this->isPaginated()->shouldBe(false);
        $pagination = new Pagination(count($this->data), 2);
        $this->withPagination($pagination)->shouldBe($this->getWrappedObject());
        $this->isPaginated()->shouldBe(true);
        $this->pagination()->shouldBe($pagination);
        $this->attribute('pagination')->shouldBe($pagination);
    }

    public function it_can_be_converted_to_json()
    {
        $this->shouldBeAnInstanceOf(\JsonSerializable::class);
        $this->jsonSerialize()->shouldBe([
            'attributes' => [],
            'data' => $this->data,
            'count' => 3,
            'isEmpty' => false
        ]);
    }
}
