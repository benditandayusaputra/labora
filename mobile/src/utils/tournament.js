import axios from '../plugins/axios';

export async function reqItemsTournament() {
  try {
    const {
      data: {data},
    } = await axios.get('tournament');

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

export async function reqItemsClub() {
  try {
    const {
      data: {data},
    } = await axios.get('club');

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

export async function reqSimpanTournament(payload) {
  try {
    const {
      data: {data},
    } = await axios.post('register_tournament', payload);
    return {status: true, message: 'Berhasil menyimpan tournament', data};
  } catch (e) {
    console.error(e);
    return {
      status: false,
      message: 'Gagal mengeksekusi api reqItemsTournament',
      data: [],
    };
  }
}

export async function reqSimpanUploadBuktiBayar(payload) {
  try {
    await axios({
      method: 'post',
      url: 'register_tournament/confirm_payment',
      headers: {'Content-Type': 'multipart/form-data'},
      transformRequest: () => {
        return payload;
      },
      data: payload,
    });
    return {status: true, message: 'Berhasil upload bukti bayar'};
  } catch (e) {
    console.error(e);
    return {
      status: false,
      message: 'Gagal mengeksekusi api reqSimpanUploadBuktiBayar',
    };
  }
}
