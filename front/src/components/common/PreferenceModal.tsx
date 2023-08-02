import Button from '../base/Button';
import Dialog from '../base/dialog';
import PreferenceForm from './PreferenceForm';

export default function PreferenceModal({  }){
    return(
        <>
            {/* Open the modal using ID.showModal() method */}
            <Button className="btn py-2 m-1 h-auto min-h-0" onClick={()=>window.pref_modal.showModal()}>preferences</Button>
            <Dialog id="pref_modal" className="modal modal-bottom sm:modal-middle">
                <PreferenceForm/>
            </Dialog>
        </>
    );
}