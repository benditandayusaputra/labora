import axiosMidtrans from '../plugins/axiosMidtrans';

export async function requestCharge(payload) {
  try {
    const {data} = await axiosMidtrans.post('charge', payload);
    return {
      status: true,
      message: 'Berhasil memproses pembayaran',
      link: data.actions[1].url,
    };
  } catch (e) {
    console.error(e);
    return {status: false, message: 'Gagal mengeksekusi api charge'};
  }
}
