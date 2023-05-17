import http from '../../util/http';

/**
 * ListItemsService
 */
class ListItemsService
{
    /**
     * Gets all registered items
     *
     * @returns {Promise<AxiosResponse<any>>}
     */
    getAll() {
        return http.get('/shopping/list');
    }

    /**
     * Creates a new Item
     *
     * @param data
     * @returns {Promise<AxiosResponse<any>>}
     */
    create(data) {
        return http.post('/shopping/create', data);
    }

    /**
     * Updates the list items
     *
     * @param data
     * @returns {Promise<AxiosResponse<any>>}
     */
    update(data) {
        return http.post('/shopping/update', data);
    }

    /**
     * Deletes an item from the list
     *
     * @param data
     * @returns {Promise<AxiosResponse<any>>}
     */
    delete(data) {
        return http.post('/shopping/delete', data);
    }
}

export default new ListItemsService();