<?php

namespace App\Utils;

class ResponseMessage
{
	public function response(string $message, bool $status = true, string $method = 'store'): string
	{
		return match ($method) {
			'store' => $status ? "$message created successfully" : "Failed to create $message",
			'update' => $status ? "$message updated successfully" : "Failed to update $message",
			'delete' => $status ? "$message deleted successfully" : "Failed to delete $message",
		};
	}
}