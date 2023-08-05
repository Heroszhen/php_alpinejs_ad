class Article {
    id = null;
    user_id = null;
    user = null;
    title = "";
    description = "eeeee";
}

document.addEventListener('alpine:init', () => {
    Alpine.data('adminarticles', () => ({
        allArticles: [],
        elmindex: null,
        articleM: null,
        dataTable: null,
        formValidation: null,
        async init() {
            isNotConnected();
            this.getAllData();
            this.articleM = new Article();
            await wait(0.5);
            let editor = new Quill('#description', {
                theme: 'snow',
                modules: {
                    'syntax': true,
                    'toolbar': [
                        [{ 'font': 'fonts' }, { 'size': [] }],
                        [{ 'header': [1, 2, 3, 4, 5] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }, { 'align': [] }],
                        ['link', 'image', 'video', 'formula'],
                        ['clean']
                    ],
                }
            });
        },
        async getAllData() {
        },
        resetForm() {

        },
        async sendForm() {
            console.log(this.articleM)
        }
    }));
});