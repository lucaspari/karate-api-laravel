<?php

namespace App\Service;
use App\Models\Kata;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class KataService
{
  public function findAllKatas(): Collection
  {
      try {
          return Kata::all();
      } catch (Exception $e) {
          Log::error($e->getMessage());
          return new Collection();
      }
  }
  public function findKataById(string $id) : Collection{
        try {
            return Kata::query()->where("faixa_id", $id)->get();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return new Collection();
        }
  }
}
