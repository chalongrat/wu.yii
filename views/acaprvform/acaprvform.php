<form id="AcaprvForm">
    <div class="section-body">
        <div style="overflow-x: auto;">

            <div class="card-body">
                <div class="section-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="overflow-x: auto;">

                                <div class="card-body">
                                    <div class="row clearfix">

                                        <div class="row flex justify-content-center">
                                            <div class="row col-md-4">
                                                <label class="form-label" name="">ลักษณะงาน</label>
                                                <span id="nameJoblevel4"></span>
                                                <ul class="list-group mt-2" id="reaLevel"></ul>
                                            </div>
                                        </div>

                                        <div class="row flex justify-content-center mt-4">
                                            <div class="col-md-4">
                                                <div class="from-group mb-3">
                                                    <label class="form-label" name="acaprv_5"></label>
                                                    <input class="form-control" type="text" id="acaprvform_title" required />
                                                </div>

                                                <div class="from-group mb-3">
                                                    <label class="form-label" name="acaprv_6"></label>
                                                    <textarea id="acaprvform_desc_st" class="form-control" rows="5" value=""></textarea>
                                                </div>

                                                <div class="row gx-1">
                                                    <div class="col-md-6 from-group mb-3">
                                                        <label class="form-label" name="acaprv_7"></label>
                                                        <input type="date" id="acaprvform_sdate" class="form-control" required>
                                                    </div>

                                                    <div class="col from-group mb-3">
                                                        <label class="form-label">&nbsp;</label>
                                                        <input type="date" id="acaprvform_edate" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="from-group mb-3" id="divDocfile">
                                                    <label class="form-label" name="acaprv_8"></label>
                                                    <input class="form-control" type="file" id="acaprvform_File" name="docFile" value="" accept=".pdf" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row">

                                        <div class="col-lg-4">

                                            <button type="button" class="bBack" onClick="$.loadPage('/acaprvform/index?formType=<?= $formType ?>', event);"></button>
                                        </div>

                                        <div class="col-lg-4 text-center">
                                            <button type="submit" class="bSave" onClick="saveData(<?= $formListID ?>)"></button>
                                        </div>

                                        <div class="col-lg-4"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    buttonClass();

    $(document).ready(function() {
        renderLabel("aps-job", lang, "apsJob");
    });
</script>