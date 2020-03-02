
<template>
    <draggable :list="sections" :options="{animation:200,handle:'.dragging-hand'}" :element="'ul'" @change="update">
        <li class="unstyle-list mb-2 top-draggable-section" v-for="(item, index) in sections" :data-id="item.id">
            <span class="dragging-hand">
                <svg class="draggable-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="100" viewBox="0 0 100 100"><g><g transform="translate(50 50) scale(0.69 0.69) rotate(0) translate(-50 -50)" style="fill:#000000"><svg fill="#000000" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" version="1.1" x="0px" y="0px"><title>Drag</title><desc>Created with Sketch.</desc><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(96.000000, 28.000000)" fill="#000000"><circle cx="45" cy="45" r="45"></circle><circle cx="274" cy="45" r="45"></circle><circle cx="45" cy="228" r="45"></circle><circle cx="274" cy="228" r="45"></circle><circle cx="45" cy="411" r="45"></circle><circle cx="274" cy="411" r="45"></circle></g></g></svg></g></g></svg>
                <b v-show="!item.edit">{{ item.name }}</b>
                <input type="text" v-model="item.name" v-show="item.edit">
            </span>
            <button class="badge badge-secondary" v-show="!item.edit" v-on:click="editSection(item)">Edit</button>
            <button class="badge badge-success" v-show="item.edit" v-on:click="changeSection(item)">Submit</button>
            <button class="badge badge-light" v-show="item.edit" v-on:click="cancelSection(item)">Cancel</button>
            <draggable :list="item.questions" :options="{animation:200,handle:'.dragging-hand',group:'allquestions'}" :element="'ul'"  @change="updateQuestions($event)">
                <li class="unstyle-list mb-2 smaller-text" v-for="question in item.questions" :data-id="question.id">
                    <div v-show="!item.delete">
                        <span class="dragging-hand">
                            <svg class="draggable-icon draggable-icon-small" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="100" viewBox="0 0 100 100"><g><g transform="translate(50 50) scale(0.69 0.69) rotate(0) translate(-50 -50)" style="fill:#000000"><svg fill="#000000" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" version="1.1" x="0px" y="0px"><title>Drag</title><desc>Created with Sketch.</desc><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(96.000000, 28.000000)" fill="#000000"><circle cx="45" cy="45" r="45"></circle><circle cx="274" cy="45" r="45"></circle><circle cx="45" cy="228" r="45"></circle><circle cx="274" cy="228" r="45"></circle><circle cx="45" cy="411" r="45"></circle><circle cx="274" cy="411" r="45"></circle></g></g></svg></g></g></svg>
                            <span v-show="!question.edit">{{ question.question }} </span>
                            <input type="text" v-model="question.question" v-show="question.edit">
                            <button class="badge badge-secondary" v-show="!question.edit" v-on:click="editQuestion(question)">Edit</button>
                            <!-- <button class="badge badge-light" v-show="!question.edit" v-on:click="deleteQuestion(question)">Delete</button> -->
                            <button class="badge badge-success" v-show="question.edit" v-on:click="changeQuestion(question)">Submit</button>
                            <button class="badge badge-light" v-show="question.edit" v-on:click="cancelQuestion(question)">Cancel</button>
                        </span>
                    </div>
                </li>
            </draggable>
        </li>
    </draggable>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable
        },
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                sections: [],
                csrf: document.head.querySelector('meta[name="csrf_token"]').content
            };
        },
        created() {
            this.fetchQuestionSections();
        },
        methods: {
            fetchQuestionSections() {
                axios.get('/admin/survey-list/2')
                    .then((res) => {
                            this.sections = res.data;
                            for (var i = this.sections.length - 1; i >= 0; i--) {
                                Vue.set(this.sections[i], 'edit', false);
                                // console.log(this.sections[i]['questions']);
                                for (var j = this.sections[i]['questions'].length - 1; j >= 0; j--) {
                                    Vue.set(this.sections[i]['questions'][j], 'edit', false);
                                    Vue.set(this.sections[i]['questions'][j], 'delete', false);
                                }
                            }

                            this.loading = false;
                    })
                    .catch((err) => console.error(err));;
            },
            update() {
                this.sections.map((section, index) => {
                    section.section_order = index + 1;
                })
                
                axios.post('/admin/survey/update-all', {
                    sections: this.sections
                }).then((response) => {
                    console.log('success.')
                })
            },
            updateQuestions(event) {
                this.sections.map((section, index) => {
                    section.section_order = index + 1;
                })

                axios.post('/admin/survey/update-all', {
                    sections: this.sections
                }).then((response) => {
                    console.log('success')
                })
            },
            editSection: function(item){
                this._originalItem = Object.assign({}, item);
                item.edit = true;

            },
            cancelSection: function(item){
                Object.assign(item, this._originalSection);
                item.edit = false;
            },
            changeSection: function(item){
                axios.post('/admin/survey/update-section', {
                    section: item
                }).then((response) => {
                    console.log('success.')
                })

                Object.assign(item, this._originalSection);
                item.edit = false;
            },
            editQuestion: function(question){
                this._originalItem = Object.assign({}, question);
                question.edit = true;

            },
            cancelQuestion: function(question){
                Object.assign(question, this._originalSection);
                question.edit = false;
            },
            changeQuestion: function(question){
                axios.post('/admin/survey/update-question', {
                    question: question
                }).then((response) => {
                    console.log('success.')
                })

                Object.assign(question, this._originalSection);
                question.edit = false;
            },
            deleteQuestion: function(question){
                Object.assign(question, this._originalSection);
                question.delete = true;
                axios.post('/admin/survey/delete-question', {
                    question: question
                }).then((response) => {
                    console.log('success.')
                })
                
            }
        },
        
    }
</script>
