import axios from "axios";

/**
 * An HTTP Service that allows for interaction with the backend
 */
export default axios.create({
    baseURL: "http://0.0.0.0:9200/v1/api",
    headers: {
        "Content-type": "application/json",
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Headers": "*"
    }
});