<?php

namespace App\Utils;

class ResponseMessage
{
	public function response(string $message, bool $status = true, string $method = 'store'): string
	{
		return match ($method) {
			'store' => $status ? "$message berhasil ditambahkan" : "Gagal menambahkan $message",
			'update' => $status ? "$message berhasil diubah" : "Gagal mengubah $message",
			'delete' => $status ? "$message berhasil dihapus" : "Gagal menghapus $message",
		};
	}
}