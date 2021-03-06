<?php

namespace App\Http\Livewire\Vote;

use App\Events\NumberOfVotesUpdated;
use App\Models\Candidate;
use Livewire\Component;

class CandidateRow extends Component
{
    public $candidate;
    public $success;

    public function mount(Candidate $candidate)
    {
        $this->candidate = $candidate;
        $this->success = '';
    }

    public function updateVote($vote)
    {
        if($this->candidate->year->status != 'COMPLETED') {
//            return redirect()->back()->with('warning', 'Cannot modify vote of Completed election');
            $this->candidate->number_of_votes = $this->candidate->number_of_votes + $vote;
            $this->candidate->save();
            $this->updateNotification();
        }


//        broadcast(new NumberOfVotesUpdated($this->candidate));
    }

    public function updateNotification()
    {
        $this->success = 'Succeded';
    }

    public function render()
    {
        return view('livewire.vote.candidate-row');
    }
}
