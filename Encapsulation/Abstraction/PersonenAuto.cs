using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;

namespace Abstraction
{
    public class PersonenAuto
    {
        private string _kenteken = string.Empty;
        public string Kenteken { get => _kenteken; set => _kenteken = value; }


        private string _merk = string.Empty;
        public string Merk { get => _merk; set => _merk = value; }


        private string _model = string.Empty;
        public string Model { get => _model; set => _model = value; }


        private double _kilometerstand = 0;
        public double Kilometerstand { get => _kilometerstand; }


        private int _bouwjaar = 0;
        public int Bouwjaar 
        { 
            get => _bouwjaar;
            set { 
                if (_bouwjaar <= DateTime.Now.Year)
                {
                    _bouwjaar = value;
                }
                else
                {
                    throw new ArgumentException("Bouwjaar mag niet in de toekomst zijn.");
                }
            }
        }


        private double _kilometerPerLiter = 0;
        public double KilometerPerLiter { get => _kilometerPerLiter; set => _kilometerPerLiter = value; }

        public int Leeftijd { get { return DateTime.Now.Year - Bouwjaar; } }

        private double _litersInTank = 0;
        public double LitersInTank { get => _litersInTank;}


        private double _maximaleTankInhoud = 0;
        public double MaximaleTankInhoud { get => _maximaleTankInhoud; }


        public void Tanken(double aantalLiters)
        {
            _litersInTank += 10;
            if (LitersInTank > MaximaleTankInhoud)
            {
                _litersInTank = MaximaleTankInhoud;
            }
        }

        public void Rijden(double aantalKilometers)
        {
            if (_litersInTank * _kilometerPerLiter <= aantalKilometers)
            {
                _kilometerstand += _litersInTank * _kilometerPerLiter;
                _litersInTank = 0;
            }
            else
            {
                _kilometerstand += aantalKilometers;
                _litersInTank -= aantalKilometers / _kilometerPerLiter;
            }

        }

        public PersonenAuto(string kenteken, string merk, string model, double kilometerstand, int bouwjaar,
            double kilometerPerLiter, double litersInTank, double maximaleTankInhoud)
        {
            Kenteken = kenteken;
            Merk = merk;
            Model = model;
            if (kilometerstand < 0)
            {
                throw new ArgumentException("Kilometerstand mag niet negatief zijn.");
            }
            _kilometerstand = kilometerstand;
            Bouwjaar = bouwjaar;
            //Leeftijd = leeftijd;
            KilometerPerLiter = kilometerPerLiter;
            _litersInTank = litersInTank;
            if (litersInTank < 0)
            {
                throw new ArgumentException("Brandstof kan niet negatief zijn.");
            }
            else if (litersInTank > maximaleTankInhoud)
            {
                throw new ArgumentException("Brandstof kan niet hoger zijn dan de maximale tankinhoud.");
            }
            _maximaleTankInhoud = maximaleTankInhoud;
        }
    }
}
