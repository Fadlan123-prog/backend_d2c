const escpos = require('escpos');
const { USB } = escpos;
const device = new USB(); // Use USB, Serial, or Network based on your printer connection
const printer = new escpos.Printer(device);

device.open(function() {
  printer
    .text('Dirty 2 Clean Tanjung Barat')
    .text('jl. Tanjung Baran No, 2B, Lenteng Agung, Jagakarsa, RT.5/RW.1, Jakarta Selatan')
    .text('08521713106')
    .text('Tanggal: 2024-07-28')
    .text('Jam: 14:30')
    .text('Nomor Plat: B 1234 CD')
    .text('Kasir: John Doe')
    .text('--------------------------------')
    .text('Item: Express Wash & Wax        100000')
    .text('Item: Silica Ceramic Coating   200000')
    .text('--------------------------------')
    .text('Total Payment: 300000')
    .text('Thank you for your business!')
    .cut()
    .close();
});
