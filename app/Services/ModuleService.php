<?php

namespace App\Services;

use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ModuleService
{
    public function createModule(array $data): Module
    {
        return DB::transaction(function () use ($data) {
            return Module::create($data);
        });
    }

    public function updateModule(Module $module, array $data): Module
    {
        return DB::transaction(function () use ($module, $data) {
            $module->update($data);
            return $module;
        });
    }

    public function deleteModule(Module $module): void
    {
        DB::transaction(function () use ($module) {
            $module->delete();
        });
    }
}
