import api from "./api";

export default {
    createVoucher(data)
    {
        return api.post("load/script/voucher/onsite", data);
    }
};
