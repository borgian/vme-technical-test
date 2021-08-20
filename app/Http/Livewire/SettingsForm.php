<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Settings;

class SettingsForm extends Component
{

    public $name,$email,$selected_id;
    public $updateMode = false;
    public function render()
    {
       return view('livewire.settings-form');
    }

    /*
     *
     * Mount all settings
     *
     * */

    public function mount()
    {

        $record = Settings::where('name',"staff_email_address")->firstOrFail();
        $this->selected_id = $record->id;
        $this->email = $record->value;
        $this->updateMode = true;

    }


    /*
     *
     * On Edit Form Submission
     *
     *
     * */
    public function update()
    {

        $this->validate([
            'email'=>'required|email'
        ]);

        if($this->selected_id)
        {
            $record = Settings::find($this->selected_id);
            $record->update([
                'value'=>$this->email
            ]);

            $this->updateMode = false;

            session()->flash('message', 'Settings Updated Successfully.');
            return redirect()->to('/settings');

        }
    }


}
