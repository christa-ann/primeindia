<!--  Modal content for the above example -->
                                        <div id="updateNoteModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
                                            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">
                                                            Add/Update Notes</h5>
                                                        <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="taskupdate" enctype="multipart/form-data" method="post">
                                                            <label>Task Update details </label>
                                                            <div class="form-group">
                                                                <textarea name="taskupdates" maxlength="100" class="form-control" placeholder="Your Task Update Details" required=""></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Upload media (4 MB) </label>
                                                                <input type="file" name="mediafile" class="form-control file">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Media  Link (> 4 MB) </label>
                                                                <input type="url" name="mediafilelink" class="form-control">
                                                            </div>

                                                            <input type="hidden" name="taskID" id="opentaskID">
                                                            <button type="submit" class="btn btn-success waves-effect waves-light" > SUBMIT
                                                           </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
 
    <div id="viewUpdateModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
                                            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">
                                                            View Notes/Updates/Media</h5>
                                                        <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>