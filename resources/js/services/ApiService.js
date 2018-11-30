export default class ApiService {

    getLinks() {
        window.axios.get('/links').then(response => response.data);
    }

    search(params) {
        window.axios.post('/search', params).then(response => response.data);
    }
}
