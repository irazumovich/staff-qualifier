<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GoalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $taskFile = $this->getTaskIleAttribute()->first();
        $modelId = $this->getTaskIleAttribute()->first() ? $this->getTaskIleAttribute()->first()->id : '';
        return [
            'pivot' => $this->pivot,
            'file' => $this->getTaskIleAttribute(),
            'id' => $this->pivot->id,
            'name' => $this->name,
            'description' => $this->description,
            'comment' => $this->pivot->comment,
            'confirmation_method' => $this->confirmation_method,
            'additional_materials' => $this->additional_materials,
            'task_file' => Storage::has("$modelId/" . $taskFile->file_name) ?
                Storage::url("$modelId/" . $taskFile->file_name) : '',
            'result_file' => Storage::has($this->pivot->result_file) ?
                Storage::url($this->pivot->result_file) : '',
            'status' => $this->pivot->status,
            'mentor_id' => $this->pivot->mentor_id,
            'assess_goals' => $this->assess_goals,
        ];
    }
}
