import axiosMidtrans from '../plugins/axiosMidtrans';
import axios from '../plugins/axios';

export async function requestCharge(payload) {
  try {
    const {data} = await axiosMidtrans.post('charge', payload);
    return {
      status: true,
      message: data?.status_message,
      link:
        data.actions?.find(res => res.name === 'deeplink-redirect')?.url ||
        data.actions?.find(res => res.name === 'generate-qr-code')?.url ||
        null,
    };
  } catch (e) {
    console.error(e);
    return {status: false, message: 'Gagal mengeksekusi api charge'};
  }
}

export async function reqItemsRekening() {
  try {
    const {
      data: {data},
    } = await axios.get('master_payment');

    return {status: true, message: 'Berhasil mendapatkan data', data};
  } catch (e) {
    console.error(e);
    return {
      status: false,
      message: 'Gagal mengeksekusi api reqItemsTournament',
      data: [],
    };
  }
}
