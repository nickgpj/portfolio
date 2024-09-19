using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using UpperLowerCase.Helpers;

namespace UpperLowerCase.Model
{
    internal class UserMessage : ObservableObject
    {
        #region fields
        public string _text = string.Empty;
        #endregion

        #region properties

        public string Text
        { 
            get { return _text; } 
            set { _text = value; OnPropertyChanged(); }
        }
    }
    #endregion
}
