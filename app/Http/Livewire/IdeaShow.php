<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners = [
        'statusWasUpdated', 
        'ideaWasUpdated', 
        'ideaWasMarkedAsSpam', 
        'ideaWasMarkedAsNotSpam', 
        'commentWasAdded'
    ];

    public function mount(Idea $idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function render()
    {
        return view('livewire.idea-show');
    }

    /**
     * Listeners
     */
    public function statusWasUpdated() {
        $this->idea->refresh();
    }

    public function ideaWasUpdated() {
        $this->idea->refresh();
    }

    public function ideaWasMarkedAsSpam() {
        $this->idea->refresh();
    }

    public function ideaWasMarkedAsNotSpam() {
        $this->idea->refresh();
    }

    public function commentWasAdded() {
        $this->idea->refresh();
    }

    /**
     * Custom Methods
     */
    public function vote() {
        if ( !auth()->check() ) {
            return redirect(route('login'));
        }

        if ( $this->hasVoted ) {
            $this->idea->removeVote( auth()->user() );
            $this->votesCount--;
            $this->hasVoted = false;
        } else {
            $this->idea->vote( auth()->user() );
            $this->votesCount++;
            $this->hasVoted = true;
        }
    }
}
