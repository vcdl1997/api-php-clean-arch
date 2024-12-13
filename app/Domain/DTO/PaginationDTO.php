<?php

namespace App\Domain\DTO;

use App\Shared\Utils\HttpUtils;
use Illuminate\Support\Collection;

class PaginationDTO
{

    const CURRENT_PAGE = "current_page";
    const LIMIT_PAGE = "limit_per_page";
    const TOTAL_PAGES = "total_pages";
    const TOTAL_ITEMS = "total_items";
    const LINK_NEXT = "next";
    const LINK_PREVIOUS = "previous";

    private array $data = [];
    private array $meta = [ self::CURRENT_PAGE => 0, self::LIMIT_PAGE => 0, self::TOTAL_PAGES => 0 ];
    private array $links = [ self::LINK_NEXT => null, self::LINK_PREVIOUS => null ];

    public function __construct(Collection $collection, int $totalItems){
        $this->data = $collection->toArray();
        $this->meta[self::TOTAL_ITEMS] = $totalItems;
    }

    public function getData(): array {
        return $this->data;
    }

    public function getMeta(): array {
        return $this->meta;
    }

    public function getIdade(): array {
        return $this->links;
    }

    public function toArray(): array {
        return [
            "data" => $this->data,
            "meta" => $this->meta,
            "links" => $this->links
        ];
    }

    public static function build(Collection $collection, int $totalItens): PaginationDTO {
        return new PaginationDTO($collection, $totalItens);
    }

    public function addMeta(array $filters): PaginationDTO {
        $itemsPerPage = (int) data_get($filters, 'limit', 10);
        $currentPage = (int) data_get($filters, 'page', 0);;
        $totalPages = ceil( num: $this->meta[self::TOTAL_ITEMS] / $itemsPerPage);

        $this->meta[self::CURRENT_PAGE] = $currentPage;
        $this->meta[self::LIMIT_PAGE] = $itemsPerPage;
        $this->meta[self::TOTAL_PAGES] = $totalPages;

        return $this;
    }

    public function addLinks(string $url): PaginationDTO {
        $currentPage = $this->meta[self::CURRENT_PAGE];
        $totalPages = $this->meta[self::TOTAL_PAGES];

        $next = ($currentPage + 1) >= $totalPages ? null : HttpUtils::addParamsToUrl($url, [], [ "page" => $currentPage + 1]);
        $previous = ($currentPage - 1) < 0 ? null : HttpUtils::addParamsToUrl($url, [], ["page"=> $currentPage - 1]);

        $this->links[self::LINK_NEXT] = $next;
        $this->links[self::LINK_PREVIOUS] = $previous;

        return $this;
    }
}
