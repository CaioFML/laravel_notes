<?php

namespace App\Services;

class Operations
{
  public static function decryptId($id)
  {
    try {
      return Crypt::decrypt($id);
    } catch (DecryptException $e) {
      return redirect()->route('home')->with('error', 'Invalid note ID.');
    }
  }
}