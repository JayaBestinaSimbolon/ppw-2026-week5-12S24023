<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class BukuEksternalController extends Controller
{
    use ApiResponse;

    /**
     * GET /api/v1/eksternal/buku/{isbn}
     * Mengonsumsi OpenLibrary API untuk memperkaya data buku berdasarkan ISBN
     */
    public function show(string $isbn): JsonResponse
    {
        // Panggil OpenLibrary API dengan timeout 8 detik
        $response = Http::timeout(8)->get("https://openlibrary.org/api/books?bibkeys=ISBN:{$isbn}&format=json&jscmd=data");

        if ($response->failed()) {
            return $this->problemResponse(
                title: 'External Service Error',
                detail: 'Gagal terhubung ke layanan eksternal OpenLibrary API.',
                status: 502,
                errorSlug: 'external-api-error'
            );
        }

        $data = $response->json();
        $key = "ISBN:{$isbn}";

        if (empty($data[$key])) {
            return $this->problemResponse(
                title: 'External Resource Not Found',
                detail: "Metadata eksternal untuk ISBN '{$isbn}' tidak ditemukan di OpenLibrary.",
                status: 404,
                errorSlug: 'external-book-not-found'
            );
        }

        $bookInfo = $data[$key];

        return $this->successResponse(
            data: [
                'isbn'           => $isbn,
                'title'          => $bookInfo['title'] ?? null,
                'publishers'     => collect($bookInfo['publishers'] ?? [])->pluck('name'),
                'publish_date'   => $bookInfo['publish_date'] ?? null,
                'number_of_pages'=> $bookInfo['number_of_pages'] ?? null,
                'cover_url'      => $bookInfo['cover']['large'] ?? $bookInfo['cover']['medium'] ?? null,
                'external_url'   => $bookInfo['url'] ?? null,
            ],
            message: 'Berhasil mengambil metadata referensi eksternal buku.'
        );
    }
}