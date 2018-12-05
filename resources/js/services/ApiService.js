export default class ApiService {

    static getLinks() {
        return window.axios.get('/links').then(response => response.data);
    }

    static search(params) {
        return window.axios.post('/search', params).then(response => response.data);
    }
}
