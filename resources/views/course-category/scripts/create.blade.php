<script>
    let courseCategoryName = document.getElementById('category-name');
    let courseCategoryNameInp = document.getElementById('category-name-inp');

    const setCourseCategoryName = () => {
        if (courseCategoryName.innerText == "" && document.activeElement != courseCategoryName) {
            courseCategoryName.innerText = "Course Category Name";
            courseCategoryNameInp.value = "";
        } else {
            courseCategoryNameInp.value = courseCategoryName.innerText;
        }
    }
</script>