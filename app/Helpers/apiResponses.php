<?php

function successResponse($data, $code = 200) {
    return response()->json(['success' => true, 'data' => $data], $code);
}

function errorResponse($message, $code = 500, $errors = []) {
    return response()->json([
        'success' => false,
        'message' => $message,
        'errors' => $errors,
    ], $code);
}


?>
