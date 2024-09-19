using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace Abstraction
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        private PersonenAuto _volkswagenGolf;

        public MainWindow()
        {
            InitializeComponent();
            _volkswagenGolf = new PersonenAuto("R-060-GX", "Volkswagen", "1.4 TSI PHEV 204PK " +
            "PANODAK GROOT NAVI ENZ", 68148, 2017, 58.8, 5, 55);
            UpdateUI();
        }


        private void UpdateUI()
        {
            tblKenteken.Text = _volkswagenGolf.Kenteken;
            tblMerk.Text = _volkswagenGolf.Merk;
            tblModel.Text = _volkswagenGolf.Model;
            tblKmStand.Text = _volkswagenGolf.Kilometerstand.ToString();
            tblBouwjaar.Text = _volkswagenGolf.Bouwjaar.ToString();
            tblLeeftijd.Text = _volkswagenGolf.Leeftijd.ToString();
            tblKmPerLiter.Text = _volkswagenGolf.KilometerPerLiter.ToString();
            tblLitersInTank.Text = Math.Round(_volkswagenGolf.LitersInTank, 2).ToString();
            //_volkswagenGolf.LitersInTank.ToString();
            tblMaxTankinhoud.Text = _volkswagenGolf.MaximaleTankInhoud.ToString();
        }
        private void btTanken_Click(object sender, RoutedEventArgs e)
        {
            double aantalLiters = 10;
            _volkswagenGolf.Tanken(aantalLiters);
            UpdateUI();
        }
        private void btRijden_Click(object sender, RoutedEventArgs e)
        {
            double aantalKilometers = 10;
            _volkswagenGolf.Rijden(aantalKilometers);
            UpdateUI();
        }
    }
}