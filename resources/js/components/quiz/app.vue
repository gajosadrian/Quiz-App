<template>
    <div v-if="started">
        <span class="d-none">{{ none }}</span>
        <b-block theme="czerwonetlo" noround full>
            <template slot="content">
                <div class="clearfix">
                    <div class="float-left">
                        <span v-if="finished || questionIndex + 1 > questions.length">Koniec</span>
                        <span v-else>Pytanie: <span class="font-w600">{{ questionIndex + 1 }}/{{ questions.length }}</span>
                        </span>
                    </div>
                    <div class="float-right">
                        Pozostały czas: <span class="font-w600"><u>{{ getTime(timer) }}</u></span>
                    </div>
                </div>
            </template>
        </b-block>
        <div v-for="(question, index) in questions" :key="index">
            <b-block v-if="index === questionIndex && !finished" theme="obramowka" noround full>
                <template slot="content">
                    <h4 v-html="question.text"></h4>
                    <div v-if="question.image" class="text-center push">
                        <img :src="question.image" class="img-fluid" style="max-width:100%;max-height:400px" :alt="question.id">
                    </div>
                    <div class="list-group push">
                        <a v-for="(response, index2) in question.responses" :key="index2" href="javascript:void(0)" class="list-group-item list-group-item-action" :class="{'active': userResponses[question.id] === response.id}" @click="click(question.id, response.id)">
                            {{ response.text }}
                        </a>
                    </div>
                    <div v-if="rememberResponses[question.id]" class="push">
                        <p class="text-primary text-center"><i>Nie możesz zmienić już odpowiedzi</i></p>
                    </div>
                    <div class="clearfix">
                        <div class="float-left" v-if="questionIndex > 0">
                            <button type="button" class="btn btn-secondary" @click="prev">Cofnij</button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-sm btn-info btn-noborder" @click="questionIndex=45">(dla testów)</button>
                            <button v-if="questionIndex < questions.length" type="button" class="btn btn-primary btn-noborder" @click="next">Dalej</button>
                        </div>
                    </div>
                </template>
            </b-block>
        </div>
        <div v-if="finished">
            <b-block theme="obramowka" noround full>
                <template slot="content">
                    <div v-if="result">
                        <p>Gratulujemy ukończenia testu!</p>
                        <ul>
                            <li>Poprawne odpowiedzi: <span class="font-w600 text-primary">{{ correctResponsesAmount }}/{{ questions.length }}</span></li>
                            <li>Czas rozwiązywania: <span class="font-w600 text-primary">{{ getTime(time) }}</span></li>
                        </ul>
                        <p>Dziękujemy za udział w konkursie. Ostatecznie wyniki 16 listopada 2018 r.</p>
                        <a :href="route('user.logout')" class="btn btn-primary btn-noborder">Koniec</a>
                    </div>
                    <div v-else>
                        <h4><i class="fa fa-spinner fa-pulse"></i> Proszę czekać...</h4>
                    </div>
                </template>
            </b-block>
        </div>
        <div v-else-if="questionIndex + 1 > questions.length">
            <b-block theme="obramowka" noround full>
                <template slot="content">
                    <p>Brakuje odpowiedzi w <span class="text-primary font-w600">{{ getNoResponsesAmount() }}</span> {{ getNoResponsesAmount() == 1 && 'pytaniu' || 'pytaniach' }}:</p>
                    <ul>
                        <li v-for="(question_index, index) in noResponseIndexes" :key="index"><span class="font-w600 text-primary">#{{ question_index + 1 }}:</span> <span v-html="questions[question_index].text"></span></li>
                    </ul>
                    <div class="clearfix">
                        <div class="float-left">
                            <button type="button" class="btn btn-secondary" @click="prev">Cofnij</button>
                            <button type="button" class="btn btn-secondary ml-5" @click="prev(null, true)">Cofnij do początku</button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-sm btn-info btn-noborder" @click="finish"><i class="fa fa-warning"></i> Zakończ quiz mimo to</button>
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
export default {
    data() { return {
        finished: false,
        result: false,
        loading: true,
        started: false,
        questionIndex: 0,
        questionId: [],
        userResponses: [],
        noResponseIndexes: [],
        rememberResponses: Array(45).fill(false),
        disableStart: false,
        // timer: 50,
        timer: 3000, // 50 min
        questions: [],
        correctResponsesAmount: 0,
        time: 0,
        none: false,
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
            let responses = [];
            this.userResponses.forEach(function(response, response_id) {
                if (response != null) {
                    responses.push({
                        id: String(response_id),
                        response: response,
                    });
                }
            });
            axios.post(route('quiz.finish'), {
                    responses: responses,
                    timeLeft: this.timer,
                })
                .then((response) => {
                    let data = response.data;
                    this.result = true;
                    this.correctResponsesAmount = data.correctResponsesAmount;
                    this.time = data.time;
                }, (error) => {
                    //
                });
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
            for (let questionIndex = 0; questionIndex < this.questions.length; questionIndex++) {
                this.noResponseIndexes.push(questionIndex);
            }
        },
        rememberResponse(question_id, questionIndex) {
            if (this.userResponses[question_id] > 0 && !this.rememberResponses[question_id]) {
                this.rememberResponses[question_id] = true;
                this.removeVal(this.noResponseIndexes, questionIndex);
            }
        },
        click(question_id, response_id) {
            if (!this.rememberResponses[question_id]) {
                this.userResponses[question_id] = response_id;
            }
        },
        next() {
            this.rememberResponse(this.questionId[this.questionIndex], this.questionIndex);
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
        getTime(value) {
            let hours =  parseInt(Math.floor(value / 3600));
            let minutes = parseInt(Math.floor((value - (hours * 3600)) / 60));
            let seconds = parseInt((value - ((hours * 3600) + (minutes * 60))) % 60);

            let dHours = (hours > 9 ? hours : '0' + hours);
            let dMins = (minutes > 9 ? minutes : '0' + minutes);
            let dSecs = (seconds > 9 ? seconds : '0' + seconds);

            return dMins + ' min ' + dSecs + ' s';
        },
        removeVal(array, element) {
            const index = array.indexOf(element);
            array.splice(index, 1);
        },
        route(name) {
            return route(name);
        },
    },
    mounted() {
        this.getQuestions();
        this.$nextTick(function () {
            window.setInterval(() => {
                this.countDown();
            }, 1000);
        })
        this.$nextTick(function () {
            window.setInterval(() => {
                this.none = !this.none;
            }, 100);
        })
        window.onbeforeunload = function() {
            return true;
        };
    },
}
</script>

<style lang="css">
</style>
