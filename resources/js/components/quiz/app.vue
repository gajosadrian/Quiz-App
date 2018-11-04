<template>
    <div v-if="started">
        <b-block full>
            <template slot="content">
                <div class="clearfix">
                    <div class="float-left">
                        Pytanie: <span class="text-primary font-w600">
                            <span v-if="!isFinished()">{{ questionIndex + 1 }}/{{ questions.length }}</span>
                            <span v-else>-</span>
                        </span>
                    </div>
                    <div class="float-right">
                        Pozostały czas: <span class="text-primary font-w600">{{ timer }} min</span>
                    </div>
                </div>
            </template>
        </b-block>
        <div v-for="(question, index) in questions" :key="index">
            <b-block v-if="index === questionIndex && !isFinished()" full>
                <template slot="content">
                    <h4>{{ question.text }}</h4>
                    <div class="list-group push">
                        <a v-for="(response, index2) in question.responses" :key="index2" href="javascript:void(0)" class="list-group-item list-group-item-action" :class="{'active': userResponses[question.id] === response.id}" @click="click(question.id, response.id)">
                            {{ response.text }}
                        </a>
                    </div>
                    <div class="clearfix">
                        <div class="float-left">
                            <button type="button" class="btn btn-secondary" @click="prev">Cofnij</button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" @click="next">Dalej</button>
                        </div>
                    </div>
                </template>
            </b-block>
        </div>
        <div v-if="isFinished()">
            <b-block>
                <template slot="content">
                    <h4><i class="fa fa-spinner fa-pulse"></i> Proszę czekać...</h4>
                </template>
            </b-block>
        </div>
    </div>
    <div v-else>
        <div v-if="loading">
            Ładowanie quizu...
        </div>
        <div v-else>
            <button type="button" class="btn btn-primary" :disabled="disableStart" @click="start">Rozpocznij quiz</button>
        </div>
    </div>
</template>

<script>
// window.onbeforeunload = function() {
//     return true;
// };

export default {
    data() { return {
        finished: false,
        loading: true,
        started: false,
        questionIndex: 0,
        userResponses: Array(45).fill(0),
        disableStart: false,
        timer: 30,
        questions: [],
    }},
    methods: {
        start() {
            this.disableStart = true;
            axios.post(route('quiz.start'))
                .then((response) => {
                    this.started = true;
                }, (error) => {
                    //
                });
        },
        finish() {
            console.log('finished');
        },
        tryFinish() {
            if (this.isFinished() && !this.finished) {
                this.finished = true;
                this.finish();
            }
        },
        isFinished() {
            return (this.questionIndex >= this.questions.length) || (this.timer <= 0);
        },
        countDown() {
            if (this.timer > 0 && this.started && !this.finished) {
                this.timer--;
                this.tryFinish();
            }
        },
        getQuestions() {
            this.loading = true;
            axios.get(route('quiz.questions'))
                .then((response) => {
                    this.loading = false;
                    this.questions = response.data;
                    this.fillResponses();
                }, (error) => {
                    //
                });
        },
        fillResponses() {
            let self = this;
            this.questions.forEach(function(question) {
                self.userResponses[question.id] = 0;
            });
        },
        click(question_id, response_id) {
            console.log(question_id, response_id);
            this.userResponses[question_id] = response_id;
        },
        next() {
            this.questionIndex++;
            this.tryFinish();
        },
        prev() {
            this.questionIndex--;
        },
    },
    mounted() {
        this.getQuestions();
        this.$nextTick(function () {
            window.setInterval(() => {
                this.countDown();
            }, 1000);
        })
    },
}
</script>

<style lang="css">
</style>
