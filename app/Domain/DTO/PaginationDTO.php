<?php

namespace App\Domain\DTO;

use App\Shared\Utils\HttpUtils;
use Illuminate\Support\Collection;
use JsonSerializable;

class PaginationDTO implements JsonSerializable
{

    const CURRENT_PAGE = "current_page";
    const LIMIT_PAGE = "limit_per_page";
    const TOTAL_PAGES = "total_pages";
    const TOTAL_ITEMS = "total_items";
    const LINK_NEXT = "next";
    const LINK_PREVIOUS = "previous";

    private array $data;
    private array $meta;
    private array $links;

    public function __construct(Collection $data, int $totalItems){
        $this->data = $data->toArray();
        $this->meta[self::TOTAL_ITEMS] = $totalItems;
    }

    public function jsonSerialize(): array {
        return [
            "data" => $this->data,
            "meta" => $this->meta,
            "links" => $this->links
        ];
    }

    public static function build(Collection $data, int $totalItens): PaginationDTO {
        return new PaginationDTO($data, $totalItens);
    }

    public function addMeta(array $filters): PaginationDTO {
        $itemsPerPage = (int) data_get($filters, 'limit', 10);
        $currentPage = (int) data_get($filters, 'page', 0);
        $totalPages = ceil( $this->meta[self::TOTAL_ITEMS] / $itemsPerPage);

        $this->meta[self::CURRENT_PAGE] = $currentPage;
        $this->meta[self::LIMIT_PAGE] = $itemsPerPage;
        $this->meta[self::TOTAL_PAGES] = $totalPages;

        return $this;
    }

    public function addLinks(string $url): PaginationDTO {
        $currentPage = $this->meta[self::CURRENT_PAGE];
        $totalPages = $this->meta[self::TOTAL_PAGES];

        $next = ($currentPage + 1) >= $totalPages ? null : HttpUtils::addParamsToUrl($url, [], [ "page" => $currentPage + 1]);
        $previous = (($currentPage - 1) < 0 || $currentPage > $totalPages) ? null : HttpUtils::addParamsToUrl($url, [], ["page"=> $currentPage - 1]);

        $this->links[self::LINK_NEXT] = $next;
        $this->links[self::LINK_PREVIOUS] = $previous;

        return $this;
    }
}
