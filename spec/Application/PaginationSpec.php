<?php

namespace spec\App\Application;

use App\Application\Pagination;
use PhpSpec\ObjectBehavior;

class PaginationSpec extends ObjectBehavior
{

    private $rows = 41;
    private $rowsPerPage = 10;
    private $pages = 5;


    function let()
    {
        $this->beConstructedWith($this->rows, $this->rowsPerPage);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Pagination::class);
    }

    function it_has_a_total_rows()
    {
        $this->rows()->shouldBe($this->rows);
    }

    function it_has_a_total_roes_per_page()
    {
        $this->rowsPerPage()->shouldBe($this->rowsPerPage);
    }

    function it_can_be_created_without_a_rows_per_page_number()
    {
        $this->beConstructedWith($this->rows);
        $this->rowsPerPage()->shouldBe(12);
    }

    function it_has_a_total_pages()
    {
        $this->pages()->shouldBe($this->pages);
    }

    function it_has_a_current_page()
    {
        $this->currentPage()->shouldBe(1);
    }

    function it_can_change_current_page_data()
    {
        $this->forPage(2)->shouldBe($this->getWrappedObject());
        $this->firstResult()->shouldBe(10);
        $this->maxResults()->shouldBe($this->rowsPerPage);
    }

    function it_can_be_converted_to_json()
    {
        $this->shouldBeAnInstanceOf(\JsonSerializable::class);
        $this->jsonSerialize()->shouldBe([
            'maxResults' => $this->rowsPerPage,
            'firstResult' => $this->firstResult()->getWrappedObject(),
            'rows' => $this->rows,
            'rowsPerPage' => $this->rowsPerPage,
            'currentPage' => $this->currentPage()->getWrappedObject(),
            'totalPages' => $this->pages()->getWrappedObject()
        ]);
    }
}
