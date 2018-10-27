<template>
    <div v-if="started">
        <div v-for="(question, index) in questions">
            <b-block v-if="index === questionIndex" full>
                <template slot="content">
                    <h4>{{ question.text }}</h4>
                    <div class="list-group push">
                        <a v-for="response in question.responses" href="javascript:void(0)" class="list-group-item list-group-item-action">
                            {{ response }}
                        </a>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" :disabled="disableNext" @click="next">Dalej</button>
                    </div>
                </template>
            </b-block>
        </div>
        <div v-if="questionIndex === questions.length">
            <b-block full>
                <template slot="content">
                    Wysyłanie wyniku. Proszę czekać...
                </template>
            </b-block>
        </div>
    </div>
    <div v-else>
        <div v-if="loading">
            Ładowanie testu
        </div>
        <div v-else>
            <button type="button" class="btn btn-primary" @click="started=true">Rozpocznij test</button>
        </div>
    </div>
</template>

<script>
export default {
    data() { return {
        loading: true,
        started: false,
        questionIndex: 0,
        userResponses: Array(45).fill(false),
        disableNext: false,
        timer: 50,
        questions: Array(45),
    }},
    methods: {
        getQuestions() {
            this.loading = true;
            axios.get(route('quiz.questions'))
                .then((response) => {
                    this.loading = false;
                    this.questions = response.data;
                }, (error) => {
                    // this.loading = false;
                });
        },
        next() {
            this.disableNext = true;
            setTimeout(() => this.disableNext = false, 1000);
            this.questionIndex++;
        },
    },
    mounted() {
        this.getQuestions();
    },
}
</script>

<style lang="css">
</style>
