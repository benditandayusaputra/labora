import axiosMidtrans from '../plugins/axiosMidtrans';

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
