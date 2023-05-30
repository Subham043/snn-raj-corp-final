<script type="text/javascript" nonce="{{ csp_nonce() }}">

const Delta = Quill.import('delta');

function quillImageHandler() {
  let fileInput = this.container.querySelector('input.ql-image[type=file]');
  if (fileInput == null) {
    fileInput = document.createElement('input');
    fileInput.setAttribute('type', 'file');
    fileInput.setAttribute('accept', '.jpg, .jpeg, .webp, .png');
    fileInput.classList.add('ql-image');
    fileInput.addEventListener('change', async () => {
      if (fileInput.files != null && fileInput.files[0] != null) {
        try {
            const data = new FormData();
            data.append('image', fileInput.files[0]);
            const response = await axios.post('{{route('texteditor_image.post')}}', data);
            let reader = new FileReader();
            reader.onload = (e) => {
            let range = this.quill.getSelection(true);
            this.quill.updateContents(new Delta()
                .retain(range.index)
                .delete(range.length)
                .insert({ image: response.data.image }));
                // console.log(fileInput.files[0]);
            }
            reader.readAsDataURL(fileInput.files[0]);
        } catch (error) {
            if(error?.response?.data?.message){
                errorToast(error?.response?.data?.message)
            }
        }

      }
    });
    fileInput.value = "";
    this.container.appendChild(fileInput);
  }
  fileInput.click();
}

const QUILL_TOOLBAR_OPTIONS_WITH_IMAGE = [
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    ['bold', 'italic', 'underline', 'strike'],
    ['blockquote', 'code-block'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],
    [ 'link', 'image' ],
    [{ 'align': [] }],
    ['clean']
];
</script>
