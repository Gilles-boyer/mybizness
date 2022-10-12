import api from "./api";

export default {
    createVoucher(data)
    {
        return api.post("load/script/voucher/onsite", data);
    },
    updateStatusUsed(id) {
        return api.put(`voucher/product/order/${id}`);
    },
    sendVoucherByMail(uuid, email)
    {
        return api.get(`voucher/${uuid}/send/mail/${email}`);
    },
    addDayToValidityVoucher(id,days)
    {
        return api.put(`voucher/${id}/update/validity/${days}`);
    }
};
