<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function listar()
    {
        return Tag::paginate(10);
    }

    public function criar(array $data): Tag
    {
        return Tag::create($data);
    }

    public function atualizar(int $id, array $data): Tag
    {
        $tag = Tag::findOrFail($id);
        $tag->update($data);
        return $tag;
    }

    public function deletar(int $id): bool
    {
        $tag = Tag::findOrFail($id);
        return $tag->delete();
    }
}
