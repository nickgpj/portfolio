using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Automation;
using System.Windows.Input;
using TellerApp.Helpers;
using TellerApp.View;

namespace TellerApp.Model
{
    internal class Teller : ObservableObject
    {
        private int _tel = 0;
        public int Tel
        {
            get => _tel;
            set
            {
                if (value >= 0 && value <= 25)
                {
                    _tel = value;
                }
                else
                {
                    throw new ArgumentOutOfRangeException("Waarde moet tussen de 0 en de 25 zijn.");
                }
                OnPropertyChanged();
            }
        }
    }
}
