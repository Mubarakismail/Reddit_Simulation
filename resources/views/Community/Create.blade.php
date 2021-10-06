<div class="modal fade" id="createCommunity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Create a community
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('Communities.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">Community title
                                :</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Community Description:</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="community_privacy" checked=""
                                value="Public">
                            <label class="custom-control-label">Public <span
                                    style="color:#7c7c7c;font-size: 12px;font-weight: 400;line-height: 16px;">
                                    Anyone can view, post, and comment to this community</span></label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="community_privacy" value="Private">
                            <label class="custom-control-label">Private <span
                                    style="color:#7c7c7c;font-size: 12px;font-weight: 400;line-height: 16px;">
                                    Only approved users can view and submit to this community</span></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
