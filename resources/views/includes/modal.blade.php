<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modal-title-custom" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content modalForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-custom">Default Bootstrap Modal</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-custom">...</div>
                <div class="modal-footer" id="modal-footer-custom">
                </div>
            </div>
        </form>
    </div>
</div>

<button class="btn btn-primary" id="openModalButton" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display:none;">Launch Modal</button>