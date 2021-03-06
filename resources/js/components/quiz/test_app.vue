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
                        Pozostały czas: <span class="font-w600">-</span>
                    </div>
                </div>
            </template>
        </b-block>
        <div v-for="(question, index) in questions" :key="index">
            <b-block v-if="index === questionIndex && !finished" theme="obramowka" noround full>
                <template slot="content">
                    <h4>{{ question.text }}</h4>
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
                            <button v-if="questionIndex < questions.length" type="button" class="btn btn-primary btn-noborder" @click="next">Dalej</button>
                        </div>
                    </div>
                </template>
            </b-block>
        </div>
        <div v-if="questionIndex + 1 > questions.length">
            <b-block theme="obramowka" noround full>
                <template slot="content">
                    <p>Dałeś radę, teraz zaczyna się prawdziwy test. Po zakończeniu quizu zobaczysz liczbę uzyskanych punktów i czas.</p>
                    <p class="text-primary font-w600 mb-0">Przypomnijmy założenia:</p>
                    <ul>
                        <li>Quiz składa się z 45 pytań i trwa maksymalnie 60 minut</li>
                        <li>Zastanów się przed zaznaczeniem odpowiedzi</li>
                        <li>Nie można zmienić odpowiedzi po naciśnięciu „Dalej”</li>
                    </ul>
                    <button type="button" class="btn btn-secondary mr-5" @click="prev">Cofnij</button>
                    <a :href="route('test')" class="btn btn-primary btn-noborder">Przejdź do quizu właściwego</a>
                </template>
            </b-block>
        </div>
    </div>
    <div v-else>
        <div class="text-center">
            <button type="button" class="btn btn-primary btn-noborder push" :disabled="disableStart" @click="start">Rozpocznij quiz kontrolny</button>
        </div>
    </div>
</template>

<script>
export default {
    data() { return {
        finished: false,
        started: false,
        questionIndex: 0,
        questionId: [],
        userResponses: [],
        rememberResponses: Array(45).fill(false),
        disableStart: false,
        questions: [],
        none: false,
    }},
    methods: {
        start() {
            this.disableStart = true;
            this.started = true;
        },
        finish() {
            // this.finished = true;
        },
        tryFinish() {
            if (this.questionIndex >= this.questions.length) {
                this.finish();
            }
        },
        getQuestions() {
            this.questions = [
                {
                    id: 1,
                    text: 'Z ilu pytań składa się test?',
                    image: null,
                    responses: [
                        { id: 1, text: '50' },
                        { id: 2, text: '» 45' },
                        { id: 3, text: '10' },
                        { id: 4, text: '100' },
                    ],
                },
                {
                    id: 2,
                    text: 'Ile punktów uzyskujemy za poprawną odpowiedź?',
                    image: null,
                    responses: [
                        { id: 1, text: '2' },
                        { id: 2, text: '5' },
                        { id: 3, text: '» 1' },
                        { id: 4, text: '0' },
                    ],
                },
                {
                    id: 3,
                    text: 'Ile wynosi limit czasu w quizie?',
                    image: null,
                    responses: [
                        { id: 1, text: '50 minut' },
                        { id: 2, text: '» 60 minut' },
                        { id: 3, text: '30 minut' },
                        { id: 4, text: '45 minut' },
                    ],
                },
                {
                    id: 4,
                    text: 'O zajętym miejscu decyduje w pierwszej kolejności?',
                    image: null,
                    responses: [
                        { id: 1, text: '» Liczba uzyskanych punktów' },
                        { id: 2, text: 'Czas' },
                        { id: 3, text: 'Moment logowania' },
                        { id: 4, text: 'Losowanie' },
                    ],
                },
            ];
            this.fillResponses();
        },
        fillResponses() {
            let self = this;
            this.questions.forEach(function(question) {
                self.userResponses[question.id] = 0;
                self.questionId.push(question.id);
            });
        },
        rememberResponse(question_id, questionIndex) {
            if (this.userResponses[question_id] > 0 && !this.rememberResponses[question_id]) {
                this.rememberResponses[question_id] = true;
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
        route(name) {
            return route(name);
        },
    },
    mounted() {
        this.getQuestions();
        this.$nextTick(function () {
            window.setInterval(() => {
                this.none = !this.none;
            }, 100);
        })
    },
}
</script>

<style lang="css">
</style>
