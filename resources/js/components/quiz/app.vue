<template>
    <div v-if="started">
        <b-block theme="czerwonetlo" noround full>
            <template slot="content">
                <div class="clearfix">
                    <div class="float-left">
                        Pytanie: <span class="font-w600">
                            <span v-if="finished || questionIndex + 1 > questions.length">-</span>
                            <span v-else>{{ questionIndex + 1 }}/{{ questions.length }}</span>
                        </span>
                    </div>
                    <div class="float-right">
                        Pozostały czas: <span class="font-w600"><u>{{ timer }} min</u></span>
                    </div>
                </div>
            </template>
        </b-block>
        <div v-for="(question, index) in questions" :key="index">
            <b-block v-if="index === questionIndex && !finished" theme="obramowka" noround full>
                <template slot="content">
                    <h4>{{ question.text }}</h4>
                    <div v-if="question.image" class="push">
                        <img :src="question.image" class="img-fluid" style="width:100%" :alt="question.id">
                    </div>
                    <div class="list-group push">
                        <a v-for="(response, index2) in question.responses" :key="index2" href="javascript:void(0)" class="list-group-item list-group-item-action" :class="{'active': userResponses[question.id] === response.id}" @click="click(question.id, response.id)">
                            {{ response.text }}
                        </a>
                    </div>
                    <div class="clearfix">
                        <div class="float-left" v-if="questionIndex > 0">
                            <button type="button" class="btn btn-secondary" @click="prev">Cofnij</button>
                        </div>
                        <div class="float-right">
                            <button v-if="questionIndex < questions.length" type="button" class="btn btn-primary btn-noborder" @click="next">Dalej</button>
                        </div>
                    </div>
                </template>
            </b-block>
        </div>
        <div v-if="finished">
            <b-block>
                <template slot="content">
                    <h4><i class="fa fa-spinner fa-pulse"></i> Proszę czekać...</h4>
                </template>
            </b-block>
        </div>
        <div v-else-if="questionIndex + 1 > questions.length">
            <b-block full>
                <template slot="content">
                    Brakuje odpowiedzi w {{ getNoResponsesAmount() }} {{ getNoResponsesAmount() == 1 && 'pytaniu' || 'pytaniach' }}:
                    <ul>
                        <li v-for="(question_id, index) in getNoResponseQuestions()" :key="index">Pytanie {{ question_id }}: text</li>
                    </ul>
                    <div class="clearfix">
                        <div class="float-left">
                            <button type="button" class="btn btn-secondary" @click="prev">Cofnij</button>
                            <button type="button" class="btn btn-secondary ml-5" @click="prev(null, true)">Cofnij do początku</button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary btn-noborder">Zakończ quiz mimo to</button>
                        </div>
                    </div>
                </template>
            </b-block>
        </div>
    </div>
    <div v-else>
        <div class="text-center">
            <div v-if="loading">
                Ładowanie quizu...
            </div>
            <div v-else>
                <button type="button" class="btn btn-primary btn-noborder" :disabled="disableStart" @click="start">Rozpocznij quiz</button>
            </div>
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
        questionId: [],
        userResponses: [],
        rememberResponses: Array(45).fill(false),
        disableStart: false,
        timer: 50,
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
            this.finished = true;
            console.log('finished');
        },
        tryFinish() {
            if (this.canFinish() && !this.finished) {
                this.finish();
            }
        },
        canFinish() {
            return (this.questionIndex >= this.questions.length && this.isComplete()) || (this.timer <= 0) || this.finished;
        },
        countDown() {
            if (this.timer > 0 && this.started && !this.finished) {
                this.timer--;
                this.tryFinish();
            }
        },
        getNoResponseQuestions() {
            let ids = [];
            this.userResponses.forEach(function(response, response_id) {
                if (response == 0) {
                    ids.push(response_id);
                }
            });
            return ids;
        },
        getResponsesAmount() {
            let amount = 0;
            this.userResponses.forEach(function(response) {
                if (response > 0) {
                    amount++;
                }
            });
            return amount;
        },
        getNoResponsesAmount() {
            return this.questions.length - this.getResponsesAmount();
        },
        isComplete() {
            return this.getNoResponsesAmount() <= 0;
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
                self.questionId.push(question.id);
            });
        },
        rememberResponse(question_id) {
            if (this.userResponses[question_id] > 0) {
                this.rememberResponses[question_id] = true;
            }
        },
        click(question_id, response_id) {
            if (!this.rememberResponses[question_id]) {
                this.userResponses[question_id] = response_id;
            }
        },
        next() {
            this.rememberResponse(this.questionId[this.questionIndex]);
            this.questionIndex++;
            this.tryFinish();
        },
        prev(e, toBeginning = false) {
            if (!toBeginning) {
                this.questionIndex--;
            } else {
                this.questionIndex = 0;
            }
        },
        removeVal(array, element) {
            const index = array.indexOf(element);
            array.splice(index, 1);
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
