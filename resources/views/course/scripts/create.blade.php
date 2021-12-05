<script>
    const editorSettings = {
        btns: [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'italic', 'underline', 'del'],
            ['fontsize', 'fontfamily', 'foreColor', 'backColor'],
            ['superscript', 'subscript'],
            ['link'],
            ['insertImage', 'upload'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat', 'table'],
            ['fullscreen'],
        ],
        plugins: {
            table: {
                rows: 20,
                columns: 20
            }
        },
        autogrow: true
    };
    const addDetails = document.getElementById('add-details');
    const addDetailsTemplate = `<div class="row mb-3" id="ad-cont-REPLACENUM">
                                <div class="col-md-3 my-auto">
                                    <h5 class="m-0" contenteditable="true" id="ad-a-REPLACENUM">Attribute Name</h5>
                                    <div class="btn-group btn-group-toggle my-2" data-toggle="buttons">
                                        <label class="btn btn-sm btn-secondary active">
                                            <input type="radio" name="ad-t-REPLACENUM" checked onchange="setContentType('ad-c-REPLACENUM', 'rich_text')"> <span class="material-icons-outlined" style="font-size: 1em">vertical_split</span>
                                        </label>
                                        <label class="btn btn-sm btn-secondary">
                                            <input type="radio" name="ad-t-REPLACENUM" onchange="setContentType('ad-c-REPLACENUM', 'plain_text')"> <span class="material-icons-outlined" style="font-size: 1em">text_snippet</span>
                                        </label>
                                        <label class="btn btn-sm btn-secondary">
                                            <input type="radio" name="ad-t-REPLACENUM" onchange="setContentType('ad-c-REPLACENUM', 'short_text')"> <span class="material-icons-outlined" style="font-size: 1em">short_text</span>
                                        </label>
                                    </div>
                                    <button class="btn btn-sm btn-danger" type="button" onclick="deleteAddDetail('ad-cont-REPLACENUM')"><span class="material-icons-outlined" style="font-size: 1em">delete</span></button>
                                </div>

                                <div class="col-md-9" id="ad-c-REPLACENUM">
                                    <div class="c-ad-c"></div>
                                </div>
                            </div>`;
    let addDetailsCount = 1;

    window.onload = () => {
        $('#description').trumbowyg(editorSettings);
        $('.c-ad-c').trumbowyg(editorSettings);
    }

    const setCourseName = () => {
        if (courseName.innerText == "" && document.activeElement != courseName) {
            courseName.innerText = "Course Name";
            courseNameInp.value = "";
        } else {
            courseNameInp.value = courseName.innerText;
        }
    }

    const setContentType = (target, type) => {
        target = document.getElementById(target);

        if (type == 'rich_text') {
            target.innerHTML = `<div class="c-ad-c"></div>`;
            $(`.c-ad-c`).not('.trumbowyg-editor').trumbowyg(editorSettings);
        } else if (type == 'plain_text') {
            target.innerHTML = `<textarea name="c-ad-c[]" class="form-control" cols="30" rows="10"></textarea>`;
        } else {
            target.innerHTML = `<input type="text" name="c-ad-c[]" class="form-control">`;
        }
    }

    const addAddDetail = () => {
        addDetails.innerHTML += addDetailsTemplate.replaceAll('REPLACENUM', addDetailsCount);
        $(`.c-ad-c`).not('.trumbowyg-editor').trumbowyg(editorSettings);
        addDetailsCount += 1;
    }

    const deleteAddDetail = target => {
        target = document.getElementById(target);
        target.parentElement.removeChild(target);
    }
</script>